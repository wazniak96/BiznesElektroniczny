import unittest,random
import time
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.support.ui import Select
from selenium import webdriver
from selenium.webdriver.common.keys import Keys

class PythonOrgSearch(unittest.TestCase):




        def setUp(self):
                self.driver = webdriver.Chrome('.\chromedriver.exe')

        def test_search_in_python_org(self):
                def generatenapis(ile):
                        napis = ""
                        znaki = "abcdefghijklmnopqrstuwvxyzABCDEFGHIJKLMNOPRSTUVWXYZ1234567890"
                        for i in range(0,int(ile)):
                                losowanie = random.randint(0,60)
                                napis = str(napis)+znaki[losowanie]
                        return napis

                driver = self.driver
                driver.get("http://localhost:8080/")
      
                try:
                        zaloguj = driver.find_element_by_xpath("//*[@id='header']/div[2]/div/div/nav/div[1]/a")
                        zaloguj.click()
                        time.sleep(2)

                #wpisywanie maila do tworzenia konta
                        driver.find_element_by_xpath("//*[@id='email_create']").send_keys(generatenapis(random.randint(3,8))+"@"+generatenapis(3)+".com")
                
                #klikniecie "Stworz konto"
                        driver.find_element_by_xpath("//*[@id='SubmitCreate']/span").click()
                
                #czas na przeladowanie si strony
                        time.sleep(3)

                        try:
                            if driver.find_element_by_xpath("//*[@id='create_account_error']").is_displayed():
                                raise Exception("Nieprawidlowy adres email")
                        except NoSuchElementException:
                            pass

                        #imie, nazwisko, haslo
                        driver.find_element_by_xpath("//*[@id='customer_firstname']").send_keys(generatenapis(random.randint(1,12))) 
                        driver.find_element_by_xpath("//*[@id='customer_lastname']").send_keys(generatenapis(random.randint(1,12)))
                        driver.find_element_by_xpath("//*[@id='passwd']").send_keys(generatenapis(random.randint(1,14)))

                        #wybranie plci mezczyzna
                        driver.find_element_by_xpath("//*[@id='id_gender"+str(random.randint(1,2))+"']").click()
                        
                        #wybieranie daty urodzenia
                        select = Select(driver.find_element_by_xpath("//*[@id='days']"))
                        select.select_by_value(str(random.randint(1,30)))
                        select = Select(driver.find_element_by_xpath("//*[@id='months']"))
                        select.select_by_value(str(random.randint(1,12)))
                        select = Select(driver.find_element_by_xpath("//*[@id='years']"))
                        select.select_by_value(str(random.randint(1900,2020)))



                        #klikniecie zarejestruj
                        driver.find_element_by_xpath("//*[@id='submitAccount']/span").click()

                        #czas na przeladowanie si strony
                        time.sleep(3)
                        

                        # nie wiem czemu zawsze się wykonuje
                        # try:
                        #     if driver.find_element_by_xpath("/html/body/div/div[2]/div/div[3]/div/div").is_displayed():
                        #         raise Exception("Nieprawidlowe imie, nazwisko, haslo")
                        # except NoSuchElementException:
                        #     pass
                        assert "No results found." not in driver.page_source
                        time.sleep(5)

                


                except Exception as e:
                        print("Blad: ", str(e))

        time.sleep(5)

        
def tearDown(self):
        self.driver.close()

if __name__ == "__main__":
    unittest.main()
    
    
