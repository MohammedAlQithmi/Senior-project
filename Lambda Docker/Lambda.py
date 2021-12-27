#                                      
# 
# 
# 
# 
# 
# 
# 
# 
#   Edge Computing                                                     Cloud
# ┌─────────────────────┐                     ┌───────────────────────────────────────────────────────────────┐
# │                     │                     │                                                               │
# │                     │                     │                                                               │
# │                     │                     │  ┌────────────┐                       ┌──────────────────┐    │
# │ Edge Python program │                     │  │            │  2. Query image ref   │                  │    │
# │                     │   1. Request        │  │            │  depending on context │                  │    │
# │                     ├─────────────────────┼─►│   Lambda   ├──────────────────────►│    Database      │    │
# │                     │                     │  │            │                       │                  │    │
# │                     │   5. Response       │  │            │  3.Image ref with     │                  │    │
# │                     │ ◄───────────────────┼──┤            │      name             │                  │    │
# │                     │                     │  │            │◄──────────────────────┤                  │    │
# └─────────────────────┘                     │  └─┬──────────┘                       └──────────────────┘    │
#                                             │    │4. get the users                                          │
#                                             │    │   images from s3                                         │
#                                             │    │                                                          │
#                                             │    ▼                                                          │
#                                             │  ┌────────────┐                                               │
#                                             │  │            │                                               │
#                                             │  │            │                                               │
#                                             │  │  S3 Backet │                                               │
#                                             │  │            │                                               │
#                                             │  │            │                                               │
#                                             │  └────────────┘                                               │
#                                             │                                                               │
#                                             └───────────────────────────────────────────────────────────────┘
#
#                                       Expected JSON format = {"type":"camera or rfid",RFID_tag_id,"RFID_reader_id": "id","face_encodings": "[]","cam_id": 30,"day":"day","time": "TIME"}
#                                       }
# 


import boto3
import json
import pymysql
import pickle
import numpy as np
import face_recognition
import timeit


def handler(event, context):
	# TODO implement
	Stage1Start = timeit.default_timer()


	device_type = event["queryStringParameters"]["type"]

	if device_type == "rfid":
		 # Stage 1: Parse JSON Request
		time = event["queryStringParameters"]["time"]
		day = event["queryStringParameters"]["day"]
		RFID_tag_id = event["queryStringParameters"]["RFID_tag_id"]
		RFID_reader_id = event["queryStringParameters"]["RFID_reader_id"]
		cam_id = event["queryStringParameters"]["cam_id"]  # Stage 2: Get the RFID_tag_id from database with names
		person_name=event["queryStringParameters"]["person_name"]
		query = "SELECT User.User_Enterprise_id, User.First_name, User.Last_name, User.RFID_tag_id, Location.Building_number, Location.Room_number  FROM (((Context INNER JOIN Location ON Context.Location_id = Location.Location_id) INNER JOIN Time_slot ON Context.Time_slot_id = Time_slot.Time_slot_id) INNER JOIN User ON Context.User_id = User.User_id) where Location.RFID_reader_id = {} and Time_slot.Day LIKE '%{}%'  and '{}' BETWEEN Time_slot.Begin_time and Time_slot.END_time".format(
			RFID_reader_id, day, time)
		query_result = getRefs(query)
		records = []
		names = []
		rfid_keys = []
		for record in query_result:
			User_id = record["User_Enterprise_id"]
			full_name = record["First_name"] + " " + record["Last_name"]
			names.append(full_name)
			rfid_reference = record["RFID_tag_id"]
			rfid_keys.append(rfid_reference)
			Building_number = record["Building_number"]
			Room_number = record["Room_number"]
			records.append({
				"User_id": User_id,
				"Name": full_name,
				"Location": Building_number + "-" + Room_number,
				"Time": time
			})
		result=""
		try:
			match_index = rfid_keys.index(RFID_tag_id)
			if records[match_index]["Name"] == person_name:
				result = "authenticated"
			else:
				result="Unknown"
		except ValueError:
			result = "Unknown"


		
		client = boto3.client('iot-data', region_name='me-south-1')
		print(result)
		response = client.publish(
			topic="{}/response".format(cam_id),
			qos=0,
			payload=json.dumps({"device_used":"rfid","payload":result})
		)

		return ""

    

	elif device_type == "camera":

		# Stage 1: Parse JSON Request
		face_encodings = []
		face_encodings_str = event["multiValueQueryStringParameters"]["face_encodings"]
		# print(type(face_encodings_str))
		# print(face_encodings_str)
		for str_encoding in face_encodings_str:
			encoding_array = [float(n) for n in str_encoding.split(" ")]
			face_encodings.append(np.array(encoding_array))

		cam_id = event["queryStringParameters"]["cam_id"]
		time = event["queryStringParameters"]["time"]
		day = event["queryStringParameters"]["day"]
		# print("face_encodings: %s , cam_id: %s , time: %s" %(face_encodings,cam_id,time))
		Stage1Stop = timeit.default_timer()
		print('Stage 1 Time: ', Stage1Stop - Stage1Start)

		Stage2Start = timeit.default_timer()
		# Stage 2: Get the keys from database with names

		known_face_names = []
		face_encoding_keys = []

		query = "SELECT User.User_Enterprise_id, User.First_name, User.Last_name, User.Image_reference, Location.Building_number, Location.Room_number  FROM (((Context INNER JOIN Location ON Context.Location_id = Location.Location_id) INNER JOIN Time_slot ON Context.Time_slot_id = Time_slot.Time_slot_id) INNER JOIN User ON Context.User_id = User.User_id) where Location.Camera_id = {} and Time_slot.Day LIKE '%{}%'  and '{}' BETWEEN Time_slot.Begin_time and Time_slot.END_time".format(
			cam_id, day, time)
		query_result = getRefs(query)

		records = []
		for record in query_result:
			User_id = record["User_Enterprise_id"]
			full_name = record["First_name"] + " " + record["Last_name"]
			known_face_names.append(full_name)
			Face_encoding_reference = record["Image_reference"]
			face_encoding_keys.append(Face_encoding_reference)
			Building_number = record["Building_number"]
			Room_number = record["Room_number"]

			records.append(
				{"User_id": User_id, "Name": full_name, "Location": Building_number + "-" + Room_number, "Time": time})

		# print("Names array : %s , Image Keys array: %s " %(known_face_names,face_encoding_keys))
		Stage2Stop = timeit.default_timer()

		print('Stage 2 Time: ', Stage2Stop - Stage2Start)

		Stage3Start = timeit.default_timer()

		# Stage 3: Get encoding from s3
		known_face_encodings = []

		for key in face_encoding_keys:
			encoding_string = getImage("m7md", key).decode()
			encoding_array = [float(n) for n in encoding_string.split(" ")]
			encoding_ndarray = np.array(encoding_array)
			known_face_encodings.append(encoding_ndarray)

		# print("Names array : %s , Face Encoding array: %s " %(known_face_names,known_face_encodings))
		Stage3Stop = timeit.default_timer()
		print('Stage 3 Time: ', Stage3Stop - Stage3Start)

		Stage4Start = timeit.default_timer()
		# Stage 4: Face recoginition part
		information = []

		for face_encoding in face_encodings:
			# See if the face is a match for the known face(s)
			matches = face_recognition.compare_faces(known_face_encodings, face_encoding, tolerance=0.52)
			name = {"User_id": "Unknown", "Name": "Unknown", "Location": Building_number + "-" + Room_number, "Time": time}

			# # If a match was found in known_face_encodings, just use the first one.
			# if True in matches:
			#     first_match_index = matches.index(True)
			#     name = known_face_names[first_match_index]

			# Or instead, use the known face with the smallest distance to the new face
			face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
			best_match_index = np.argmin(face_distances)
			if matches[best_match_index]:
				name = records[best_match_index]

			information.append(name)

		Stage4Stop = timeit.default_timer()
		print('Stage 4 Time: ', Stage4Stop - Stage4Start)

		# Stage 5: Construct http respons

		response_object = {}
		response_object['statusCode'] = 200
		response_object['headers'] = {}
		response_object['headers']['Content-Type'] = 'application/json'
		response_object['body'] = json.dumps(information)

		client = boto3.client('iot-data', region_name='me-south-1')

		# Change topic, qos and payload
		response = client.publish(
			topic="{}/response".format(cam_id),
			qos=0,
			payload=json.dumps({"device_used":"camera","payload":information})
		)
		print("Done")

		return response_object


# get image from s3 bucket using its url
def getImage(bucketName, key):
	s3 = boto3.client('s3')
	response = s3.get_object(Bucket=bucketName, Key=key)
	content = response['Body'].read()
	return content


# get images refrences from database with the names connected with it
def getRefs(Query):
	conn = pymysql.connect(host='', user='',
	                       database='', password='',
	                       cursorclass=pymysql.cursors.DictCursor)
	with conn.cursor() as cur:
		cur.execute(Query)
		conn.commit()
		cur.close()
		conn.close()

	return cur
