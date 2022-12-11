On Error Resume Next
            Set objProc = GetObject ("winmgmt:\\.\root\cimv2: win32_processor = 'cpu0' ")
            WScript.Echo (objProc.LoadPercentage) 