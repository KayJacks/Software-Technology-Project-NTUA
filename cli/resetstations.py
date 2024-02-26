import argparse
import requests
import json

def resetstations(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.post('http://localhost:8000/interoperability/api/admin/resetstations', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True


parser = argparse.ArgumentParser()
parser.add_argument('--apikey', help = 'Give API key', required = 'TRUE')
args = parser.parse_args()

resetstations(args)