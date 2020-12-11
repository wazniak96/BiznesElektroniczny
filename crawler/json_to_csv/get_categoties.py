import json
import pandas as pd
import numpy as np

f = open("data.json", "r",encoding='utf8')

data = json.loads(f.read())

categories = []

for template in data:
	if template['first_category'] not in categories:
		categories.append(template['first_category'])
		
	if template['second_category'] not in categories:
		categories.append(template['second_category'])

ids = range(5, len(categories)+5)
active = [1] * len(categories)
parents = ["Główna"] * len(categories)
	
tmp = {"Category ID": ids, "Active": active, "Name": categories, "Parent Category": parents}

df = pd.DataFrame(tmp, columns=["Category ID", "Active", "Name", "Parent Category"])
df.to_csv('categories.csv', index=False, sep=';', encoding='UTF-8')

print("Gotowe!")

