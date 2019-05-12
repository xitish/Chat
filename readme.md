# Chat Without Internet
#### A web based application for local message exchange without internet traffic.
<hr>

## Introduction
Chat Without internet is an web based application that allows you to send text messages and files to your friends connected to the __same network__.

<p align="center"><img src="http://pukarg.com.np/MainAssets/41.png" height=10%></p>

This system does not use internet traffic as messages are stored locally in one of the PC's (which act as a server). <br>
This system is very benificial for organizational use. Large organizations can use this system to send messages and file within their offices and employees. As this System does no incur internet charges, it is cheap and private as it is limited only within the orgalization. 
It is also useful in cases where communication is to be established but internet access should be blocked. In schools to provide study materials to the students etc.

> __This application also supports exchanging of files (Currently, only audio messages are handled properly)__

## Setup
 In order to use this system, one must have the above files on one of the PC's and corresponding database should be set up in that PC. <br>
 The database schema is also provided. <br>
 The files and the database should be hosted by one of the PC's in the network.
XAMPP Server or any other similar application can be used for hosting the files and database locally.

## Usage
- After the server PC has been set up, the PC should be connected in a network and its IP should be noted.
- To use this service on another device, the device should also be connected in the __same network__. After connection, the IP of the PC (obtained from previous step) should be inserted in the address bar of browser of that device.
- The user should first register with Name, Email ad Password and then LogIn to use this service.

## Limitations
- A section of the page is refreshed every few seconds to check for new incoming messages. Due to this, playing of the audio message will be interrupted.
- User can send any files in the message. Provisions have been made to only handle the __audio message__ properly and other types of files might not be handled properly.

## Contributors
- Pukar
- Dependra

Pull requests accepted.
