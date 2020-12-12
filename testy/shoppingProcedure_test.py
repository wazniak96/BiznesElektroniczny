import unittest,random
import time
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium import webdriver

class PythonOrgSearch(unittest.TestCase):

    def setUp(self):
        options = webdriver.ChromeOptions()
        options.add_argument('ignore-certificate-errors')

        self.driver = webdriver.Chrome('.\chromedriver.exe', chrome_options=options)

    def test_search_in_python_org(self):
        def generatenapis(ile):
            napis = ""
            znaki = "abcdefghijklmnopqrstuwvxyzABCDEFGHIJKLMNOPRSTUVWXYZ1234567890"
            for i in range(0, int(ile)):
                losowanie = random.randint(0, 60)
                napis = str(napis) + znaki[losowanie]
            return napis

        driver = self.driver

        #Dodanie produktów z kategorii szablonów joomla!
        categories = ["https://localhost/61-joomla-cms", "https://localhost/55-sklepy-prestashop"]
        units_from_category = 2
        for category in categories:
            driver.get(category)
            time.sleep(5)
            
            for i in range(1, units_from_category + 1):
                driver.find_element_by_xpath(f"/html/body/div/div[2]/div/div[3]/div[2]/ul/li[{i}]/div/div[1]/div/a[1]").click()
                time.sleep(2)
                assert('Strona przykładowa' in driver.page_source)
                driver.find_element_by_xpath('//*[@id="quantity_wanted"]').send_keys(Keys.DELETE)
                driver.find_element_by_xpath('//*[@id="quantity_wanted"]').send_keys(random.randint(1, 4))
                driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/div/div/div[4]/form/div/div[3]/div/p/button').click()
                time.sleep(2)
                assert(driver.find_element_by_xpath('//*[@id="layer_cart"]').is_displayed() is True)
                driver.find_element_by_xpath('/html/body/div/div[1]/header/div[3]/div/div/div[4]/div[1]/div[2]/div[4]/span').click()
                time.sleep(1)
                driver.get(category)

        #Kasowanie produktu z koszyka
        driver.find_element_by_xpath('/html/body/div/div[1]/header/div[3]/div/div/div[3]/div/a').click()

        assert('Podsumowanie zakupów' in driver.page_source)

        driver.find_element_by_xpath('//*[@id="1_0_0_0"]').click()
        time.sleep(2)

        row_count = len(driver.find_elements_by_xpath('//*[@id="cart_summary"]/tbody/tr'));
        print(row_count)
        assert(row_count == (len(categories) * units_from_category - 1))

        driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/p[2]/a[1]').click()
        time.sleep(1)
        assert('Stwórz konto' in driver.page_source)

        #Rejestracja użytkownika
        driver.find_element_by_xpath('//*[@id="email_create"]').send_keys(generatenapis(random.randint(3,8))+"@"+generatenapis(3)+".com")

        driver.find_element_by_xpath('//*[@id="SubmitCreate"]').click()
        time.sleep(3)

        assert('Twoje dane osobiste' in driver.page_source)

        driver.find_element_by_xpath("//*[@id='customer_firstname']").send_keys("Filip")
        driver.find_element_by_xpath("//*[@id='customer_lastname']").send_keys("Filipowicz")
        driver.find_element_by_xpath("//*[@id='passwd']").send_keys("sadsadadasdaSDASDA4!")

        driver.find_element_by_xpath("//*[@id='id_gender" + str(random.randint(1, 2)) + "']").click()

        select = Select(driver.find_element_by_xpath("//*[@id='days']"))
        select.select_by_value(str(random.randint(1, 30)))
        select = Select(driver.find_element_by_xpath("//*[@id='months']"))
        select.select_by_value(str(random.randint(1, 12)))
        select = Select(driver.find_element_by_xpath("//*[@id='years']"))
        select.select_by_value(str(random.randint(1900, 2020)))

        driver.find_element_by_xpath("//*[@id='submitAccount']").click()
        time.sleep(3)
        #driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/p[3]/a[1]').click()
        #time.sleep(1)

        #Adresy
        assert('Twoje adresy' in driver.page_source)

        driver.find_element_by_xpath('//*[@id="address1"]').send_keys('Uliczna 5')
        driver.find_element_by_xpath('//*[@id="postcode"]').send_keys('80-255')
        driver.find_element_by_xpath('//*[@id="city"]').send_keys('Gdańsk')
        driver.find_element_by_xpath('//*[@id="phone"]').send_keys('666666666')

        driver.find_element_by_xpath('//*[@id="submitAddress"]').click()
        time.sleep(1)

        #Wybor adresu do rozliczenia
        assert('Wybierz adres do rozliczeń' in driver.page_source)

        driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/form/p/button').click()
        time.sleep(1)

        #Wysyłka
        assert('Nie potrzeba przewoźnika dla tego zamówienia' in driver.page_source)

        driver.find_element_by_xpath('//*[@id="cgv"]').click()
        driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/div/form/p/button').click()
        time.sleep(1)

        #Metody platnosci
        assert('Wybierz metodę płatności' in driver.page_source)
        driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/div/div[3]/div[1]/div/p/a').click()
        time.sleep(1)
        assert('Płatność przelewem' in driver.page_source)
        driver.find_element_by_xpath('/html/body/div/div[2]/div/div[3]/div/form/p/button').click()
        time.sleep(3)
        assert('Twoje zamówienie na Templates4U jest gotowe.' in driver.page_source)

        #Status zamowienia
        driver.find_element_by_xpath('/html/body/div/div[3]/footer/div/section[3]/div/ul/li[1]/a').click()
        time.sleep(2)
        assert('Historia zamówień' in driver.page_source)
        assert('Oczekiwanie na płatność przelewem bankowym' in driver.page_source)

        time.sleep(3)


    def tearDown(self):
        self.driver.close()


if __name__ == "__main__":
    unittest.main()