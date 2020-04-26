import json
import subprocess

def addPrize(name, url):
	f = open('prizes.json')
	json_string = f.read()
	data = json.loads(json_string)
	data[name] = url
	print(data)

	with open('prizes.json', 'w') as outfile:
		json.dump(data, outfile)
		
 
def downloadimage(filepath,url):
  
  command = "curl -L " + url + " -o " + filepath
  subprocess.call(command, shell=True)

while True:
 name = input("name: " )
 url = input("url: " )
 imagename = name.replace(" ", "")
 filepath = "./images/"+imagename+".jpg"
 addPrize(name, filepath )
 downloadimage(filepath, url)




