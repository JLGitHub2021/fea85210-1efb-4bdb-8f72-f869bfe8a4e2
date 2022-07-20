import pymysql
import subprocessor
import time

args = [
    'docker-compose',
    'build'
]
retureCode = subprocessor.call(args)

if retureCode == 0:
    print('docker-compose build is Done!')
    args = [
        'docker-compose',
        'up',
        '-d'
    ]
    retureCode = subprocessor.call(args)
    if retureCode == 0:
        print('Containers are up, give them a bit time before creating table.')
        time.sleep(10)

        conn = pymysql.connect(host='127.0.0.1',port=9906,user='root',passwd='1234',db='june-test')
        cur = conn.cursor()

        query = "drop table if exists `june-test`;"
        cur.execute(query)

        query = """
                create table `june-test` (
                    id int not null auto_increment,
                    username text not null,
                    password text not null,
                    primary key(id)
                );"""
        print("creat table june-test")
        cur.execute(query)

        print("insert sample data")
        query = """
                insert into `june-test` (username, password) values
                ("user1", "pswd1"),
                ("user2", "pswd2");"""
        cur.execute(query)
        conn.commit()

        cur.close()
        conn.close()
else:
    print('Failed to build images. Please check if Docker Destop is running.')