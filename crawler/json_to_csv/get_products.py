import json
import pandas as pd

f = open("data.json", "r",encoding='utf8')

data = json.loads(f.read())
for j in range(0, 5):
	products = {	"Products ID": [], 				
					"Active": [],					
					"Name": [], 					
					"Categories": [], 				
					"Price": [], 					
					"Tax rules ID": [], 
					"Reference": [],
					"Quantity": [],	
					"Minimal quantity": [],	
					"Short description": [],
					"URL rewritten": [],
					"Product available date": [],
					"Product creation date": [],
					"Show price": [],
					"Image URLs": [],
					"Feature": []
				}

	for i in range(100 * j, 100*(j+1)):
		products["Products ID"].append(i+1)
		products["Active"].append(1)
		products["Name"].append(f"Szablon {data[i]['id']}")
		products["Categories"].append(f"Główna,{data[i]['first_category']},{data[i]['second_category']}")
		products["Price"].append(data[i]['price'])
		products["Tax rules ID"].append(1)
		products["Reference"].append(data[i]['id'])
		products["Quantity"].append(-1)
		products["Minimal quantity"].append(0)
		products["Short description"].append(f"Niniejszy szablon oferuje następujące funkcje: {data[i]['basic_functions']}")
		products["URL rewritten"].append(f"szablon-{data[i]['id']}")
		products["Product available date"].append("2020-12-01")
		products["Product creation date"].append("2020-12-01")
		products["Show price"].append(1)
		products["Image URLs"].append(data[i]['image'])
		products["Feature"].append(f"Typ szablonu|{data[i]['type']}|1|1,Numer szablonu|{data[i]['id']}|2|1,Strona przykładowa|<a href=\"{data[i]['example_url']}\"><b>Zobacz</b></a>|3|1,Autor|{data[i]['author']}|4|1" )

	df = pd.DataFrame(products, columns=["Products ID","Active","Name","Categories","Price","Tax rules ID","Reference","Quantity","Minimal quantity","Short description","URL rewritten","Product available date","Product creation date","Show price","Image URLs","Feature"])
	df.to_csv(f'products_{j}.csv', index=False, sep=';', encoding='UTF-8')

print("Gotowe!")

