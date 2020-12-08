import scrapy
import urllib.request


class Templates(scrapy.Spider):
	name = "templates"

	categories = [
		'https://www.szablonystron.eu/szablony-wordpress-cms-type/',
		'https://www.szablonystron.eu/szablony-joomla-type/',
		'https://www.szablonystron.eu/szablony-drupal-type/',
		'https://www.szablonystron.eu/sklepy-woocommerce-type/',
		'https://www.szablonystron.eu/sklepy-prestashop-type/',
		'https://www.szablonystron.eu/sklepy-magento-type/'
	]
	
	def start_requests(self):
		for i in range(0, len(self.categories)):
			for j in range(1, 7):
				yield scrapy.Request(url=f"{self.categories[i]}{str(j)}", callback=self.parse)

	def parse(self, response):
		self.log(f'Scraped url: {response.url}')
		for product in response.xpath("//div[@class='template_thumbnail']/a/@href"):
			yield scrapy.Request(url=f'https://www.szablonystron.eu{product.extract()}', callback=self.parse_product)
	
	def parse_product(self, response):
		self.log(f'Scraped product url: {response.url}')
		
		img = response.xpath("//*[@id='url234']/@src").extract()[0]
		template_id = response.xpath("//dl[@class='template_number']//dd/text()").get().strip()
		basic_functions = response.xpath("/html/body/div/main/section/div/div/div[2]/ul[2]/p[3]/text()").get()
		author = response.xpath("/html/body/div/main/section/div/div/div[2]/ul[2]/b/u/a/text()").get()
		
		if basic_functions == None or author == None:
			author = response.xpath("/html/body/div/main/section/div/div/div[2]/ul[2]/p[3]/strong[1]/text()").get()
			basic_functions = response.xpath("/html/body/div/main/section/div/div/div[2]/ul[2]/p[3]/text()")[6].get()
		
		if basic_functions != None and author != None:
			urllib.request.urlretrieve(img, f"images/{template_id}.jpg")
			
			yield {
				'id': template_id,
				'example_url': response.xpath("//div[@class='template-screenshots']/a/@href")[0].extract(),
				'image_name': f"{template_id}.jpg",
				'type': response.xpath("/html/body/div/main/section/div/div/div[2]/ul[2]/p[1]/text()").get().strip(),
				'basic_functions': basic_functions.strip(),
				'author': author.strip(),
				'first_category': response.xpath("/html/body/div/main/section/div/ul/li[2]/a/text()").get().strip(),
				'second_category': response.xpath("/html/body/div/main/section/div/ul/li[3]/a/text()").get().strip()
			}
			
			
		
		
		