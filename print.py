import json

f = open("result.txt")
string = f.readlines()
json_data = {}
for x in string:
  #print(x)	
  split = x.split(":")
  key = split[0]
  frequency = split[1]
  print(key)
  json_data[key] = frequency
  
with open("wordlist.json", "w") as outfile:
   json.dump(json_data, outfile)

