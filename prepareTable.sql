drop table if exists `june-test`;

create table `june-test` (
                    id int not null auto_increment,
                    username text not null,
                    password text not null,
                    primary key(id)
                );

insert into `june-test` (username, password) values
                ("user1", "pswd1"),
                ("user2", "pswd2");