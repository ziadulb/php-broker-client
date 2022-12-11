import os
import psutil


v1= str(psutil.cpu_count(logical=False))
v2= str(psutil.cpu_count(logical=True))
v3= str(psutil.cpu_percent(interval=1))
v4= str(round(psutil.virtual_memory().available/1000000000, 2))
v5= str(psutil.virtual_memory().percent)

cpu_info = {"cpu_count": (psutil.cpu_count(logical=False)), 
               "cpu_count_logical": psutil.cpu_count(logical=True), 
               "cpu_percent": psutil.cpu_percent(interval=1), 
               #"cpu_percent_pre": psutil.cpu_percent(interval=1, percpu=True), 
               "virtual_memory": round(psutil.virtual_memory().available/1000000000, 2), 
               "virtual_memory_precent": psutil.virtual_memory().percent,}

               
print('{"cpu_count":"%s","cpu_count_logical":"%s","cpu_percent":"%s","virtual_memory":"%s","virtual_memory_precent":"%s"}' % (v1, v2 ,v3 , v4, v5))



# def my_function():