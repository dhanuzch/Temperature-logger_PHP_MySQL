
# Temperature-logger_PHP_MySQL

## Working:
Display Temperature and humidity Data from NodeMCU as a graph in webpage

## Features:
1. Auto Refresh the website
2. MySQL based
3. Displays temperature and humidity data in separate graphs.
4. Added CSS, so visually looks better.
5. Out of the box compatibility with NodeMCU. For other MCUs minor alterations are needed.

## How to use?
1. Upload the code in `Arduino Sketch` to NodeMCU
2. Paste the `PHP` folder in `htdocs` folder


## Libraries needed:
1. DHT.h
2. WiFiClient.h
3. ESP8266WiFi.h
4. ESP8266WebServer.h
5. ESP8266mDNS.h
6. SPI.h

## TODO

 - [x] Auto Refresh
       
 - [x] Auto Refresh with one output at a time (not all outputs at a
       time)
 - [x] Add CSS and make it look good, preferably add Gauges to display
       Data
                   
 - [x] Set Graph axes min and max
                            
 - [x] Display latest 15 Data in Graph
                                   
 - [x] Work on readme

 
