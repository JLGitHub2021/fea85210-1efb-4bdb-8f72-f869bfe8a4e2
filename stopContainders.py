import subprocessor

args = [
    'docker-compose',
    'stop'
]
retureCode = subprocessor.call(args)