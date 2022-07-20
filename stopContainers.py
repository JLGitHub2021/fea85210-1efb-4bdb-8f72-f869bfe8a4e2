import subprocessor

args = [
    'docker-compose',
    'stop'
]
retureCode = subprocessor.call(args)
if retureCode == 0:
    print("Containers are stopping...")