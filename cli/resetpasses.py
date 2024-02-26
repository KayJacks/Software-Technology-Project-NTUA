import argparse
import requests
import json

def resetpasses(ar):
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.post('http://localhost:8000/interoperability/api/admin/resetpasses', headers = headers, verify = False)
    print(res.status_code)
    print(res.json())
    return True


parser = argparse.ArgumentParser()
parser.add_argument('--apikey', help = 'Give API key', required = 'TRUE')
args = parser.parse_args()

resetpasses(args)