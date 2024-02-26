import argparse
import requests
import sys
import json
from pathlib import Path

def healthcheck(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.get('http://localhost:8000/interoperability/api/admin/healthcheck', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True

def resetpasses(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.post('http://localhost:8000/interoperability/api/admin/resetpasses', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True

def resetstations(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.post('http://localhost:8000/interoperability/api/admin/resetstations', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True

def resetvehicles(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.post('http://localhost:8000/interoperability/api/admin/resetvehicles', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True    


def passesupd(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    files = {'file': open(ar.source, 'rb')}
    res = requests.post('http://localhost:8000/interoperability/api/admin/system/passesupd', headers = headers, files = files, verify = False)
    print(res)
    print(res.status_code)
    print(res.json())
    return True

if (__name__ == '__main__'):
    parser = argparse.ArgumentParser(prefix_chars = '+')
    subs = parser.add_subparsers(help = 'sub-command help')

    #--healthcheck
    healthcheck_parser = subs.add_parser('--healthcheck', help = 'Perform a system healthcheck')
    healthcheck_parser.add_argument('--apikey',help = "Admin's api key",required = True)
    healthcheck_parser.set_defaults(func = healthcheck)

    #--resetpasses
    resetpasses_parser = subs.add_parser('--resetpasses', help = 'Reset Passes')
    resetpasses_parser.set_defaults(func = resetpasses)
    resetpasses_parser.add_argument('--apikey',help = "Admin's api key",required = True)
    
    #--resetstations
    resetstations_parser = subs.add_parser('--resetstations', help = 'Reset Stations')
    resetstations_parser.set_defaults(func = resetstations)
    resetstations_parser.add_argument('--apikey',help = "Admin's api key",required = True)
    
    #--resetvehicles
    resetvehicles_parser = subs.add_parser('--resetvehicles', help = 'Reset Vehicles')
    resetvehicles_parser.set_defaults(func = resetvehicles)
    resetvehicles_parser.add_argument('--apikey',help = "Admin's api key",required = True)    
    
    args = parser.parse_args()
    
    if hasattr(args, 'func'):
        if args.func.__name__ == 'healthcheck':
            healthcheck(args)
        elif args.func.__name__ == 'resetpasses':
            resetpasses(args)
        elif args.func.__name__ == 'resetstations':
            resetstations(args)
        elif args.func.__name__ == 'resetvehicles':
            resetvehicles(args)
        elif args.func.__name__ == 'passesupd':
            passesupd(args)
    else:
        parser.print_help()
        sys.exit(2)       