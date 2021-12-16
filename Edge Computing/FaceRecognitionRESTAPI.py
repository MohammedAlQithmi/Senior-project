import cv2
import numpy as np
import face_recognition
import json
import requests
import datetime

import timeit



#Your statements here




'''
Open cam

take frame

check procedure


find faces and convert it to encodings


send the encodings to the cloud


RFID part






'''
cam_id = 1


def send_to_cloud(encodings_str, cam_id):
	URL = "https://snfxfjf9hh.execute-api.me-south-1.amazonaws.com/Test/test"

	time = datetime.datetime.now()

	days = {"Saturday": "S", "Sunday": "U", "Monday": "M", "Tuesday": "T", "Wednesday": "W", "Thursday": "R",
	        "Friday": "F"}

	json_request = {
		"face_encodings": encodings_str,
		"cam_id": cam_id,
		"time": time.strftime("%H:%M"),
		"day": days[time.strftime("%A")]
	}

	test_request = {
        "type":"camera",
		"face_encodings": encodings_str,
		"cam_id": cam_id,
		"time": "09:30",
		"day": "m"
	}

	r = requests.request("GET", URL, params=test_request)

	return r.json()


def encodings2str(encodings):
	encodings_str = []

	for encoding in encodings:
		# Convert numpy array to python array
		encoding_array = encoding.tolist()

		# Convert python array to string and append it to the face_encodings_str
		encodings_str.append(" ".join(str(e) for e in encoding_array))

	return encodings_str


# open the camera
video_capture = cv2.VideoCapture(0)
video_capture.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
video_capture.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)
# Initialize some variables

process_this_frame = True

while True:
	# Grab a single frame of video

	ret, frame = video_capture.read()

	# Resize frame of video to 1/4 size for faster face recognition processing
	small_frame = cv2.resize(frame, (0, 0), None, 0.25, 0.25)

	# Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
	rgb_small_frame = cv2.cvtColor(small_frame, cv2.COLOR_BGR2RGB)

	# Only process every other frame of video to save time
	if process_this_frame:
		face_locations = []
		face_encodings = []
		face_names = []
		# Find all the faces and face encodings in the current frame of video
		startBig = timeit.default_timer()
		face_locations = face_recognition.face_locations(rgb_small_frame)
		face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)
		stopBig = timeit.default_timer()
		print('process Time: ', stopBig - startBig)
		# Convert face encodings to str to ease sending it to the cloud
		if len(face_encodings) != 0:
			face_encodings_str = encodings2str(face_encodings)
			start = timeit.default_timer()
			user_information = send_to_cloud(face_encodings_str, cam_id)
			stop = timeit.default_timer()
			print('Req time: ', stop - start)
			for information in user_information:
				print(information)
			print("New request")

	# Send the frame encodings do the cloud

	process_this_frame = not process_this_frame

	# Display the results

	# Display the resulting image
	#cv2.imshow('Video', frame)

	# Hit 'q' on the keyboard to quit!
	if cv2.waitKey(1) & 0xFF == ord('q'):
		break

# Release handle to the webcam
video_capture.release()
cv2.destroyAllWindows()
