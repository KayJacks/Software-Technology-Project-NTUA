import argparse
import requests
import json
from pathlib import Path
from datetime import date
from prettytable import from_csv
from prettytable import DEFAULT

def passes_per_station(ar):
    url = 'http://localhost:8000/interoperability/api/passesperstation/' + str(ar.station) + '/' + ar.datefrom + '/' + ar.dateto
    if (ar.format == 'csv'):
        url = url + '?format=csv'   
    headers = {'x-observatory-auth' : ar.apikey}
    res = requests.get(url, headers = headers, verify = False)
    print(res.status_code)
    #print(res.json())
    if ((ar.format == 'json') and (res.status_code == 200)):
        print(json.dumps(res.json(), indent = 4, sort_keys = False))
    elif ((ar.format == 'csv') and (res.status_code == 200)):
        f = open("./PassesPerStation.cv",'w+')
        f.truncate(0)
        f.write(res.text)
        f.seek(0)
        x = from_csv(f, delimiter = ',')
        x.set_style(DEFAULT)
        print(x)
        f.close()
    return True

parser = argparse.ArgumentParser()
parser.add_argument('--apikey', help = 'Give API key', required = 'TRUE')
parser.add_argument('--station', help = 'Choose station id', required = 'TRUE')
parser.add_argument('--datefrom', help = 'Choose start of period', required = 'TRUE')
parser.add_argument('--dateto', help = 'Choose end of period', required = 'TRUE')
parser.add_argument('--format', choices = ['csv','json'], help = 'Choose format (json or csv)', required = 'TRUE')
args = parser.parse_args()

passes_per_station(args)
