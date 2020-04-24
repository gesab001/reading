import json

def addPrize(name, url):
	f = open('prizes.json')
	json_string = f.read()
	data = json.loads(json_string)
	data[name] = url
	print(data)

	with open('prizes.json', 'w') as outfile:
		json.dump(data, outfile)


while True:
 name = input("name: " )
 url = input("url: " )
 addPrize(name, url)




