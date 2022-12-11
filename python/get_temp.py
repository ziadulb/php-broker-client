#import wmi
#w_temp = wmi.WMI(namespace="root\\wmi")
#print_r(w_temp);

import os
import psutil

#Physical cores
print(f"Number of physical cores: {psutil.cpu_count(logical=False)}")
#Logical cores
print(f"Number of logical cores: {psutil.cpu_count(logical=True)}")



#Current frequency
#print(f"Current CPU frequency: {psutil.cpu_freq().current}")
#Min frequency
#print(f"Min CPU frequency: {psutil.cpu_freq().min}")
#Max frequency
#print(f"Max CPU frequency: {psutil.cpu_freq().max}")


#System-wide CPU utilization
print(f"Current CPU utilization: {psutil.cpu_percent(interval=1)}")
#System-wide per-CPU utilization
print(f"Current per-CPU utilization: {psutil.cpu_percent(interval=1, percpu=True)}")


#Total RAM
#print(f"Total RAM installed: {round(psutil.virtual_memory().total/1000000000, 2)} GB")
#Available RAM
print(f"Available RAM: {round(psutil.virtual_memory().available/1000000000, 2)} GB")
#Used RAM
#print(f"Used RAM: {round(psutil.virtual_memory().used/1000000000, 2)} GB")
#RAM usage
print(f"RAM usage: {psutil.virtual_memory().percent}%")


 
# Calling psutil.cpu_precent() for 4 seconds
#print('The CPU usage is: ', psutil.cpu_percent(4))


# Getting loadover15 minutes
#load1, load5, load15 = psutil.getloadavg()
 
#cpu_usage = (load15/os.cpu_count()) * 100
 
#print("The CPU usage is : ", cpu_usage)

