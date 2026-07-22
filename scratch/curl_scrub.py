import urllib.request
try:
    response = urllib.request.urlopen('http://localhost/attwood/scratch/db_scrub.php')
    print(response.read().decode('utf-8'))
except Exception as e:
    print("Error:", e)
