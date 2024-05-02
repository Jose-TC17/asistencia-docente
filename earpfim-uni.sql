CREATE DATABASE EARPFIM;

USE EARPFIM;

-- CREACION DE LA TABLA DE LOS DOCENTES

CREATE TABLE teachers(
	teachers_id int not null identity(1,1) primary key,
	name_teacher varchar(100) not null,
	lastnameP_teacher varchar(100) not null,
	lastnameM_teacher varchar(100) not null,
	user_teacher varchar(100) not null unique,
	email_teacher varchar(100) not null unique,
	password_teacher varchar(100),
	phonenumber char(10) not null unique,
	created_date date not null default (GetDate()),
	created_hour time not null default convert(time, GetDate())
);


CREATE TABLE attendance(
	asis_id int primary key identity(1,1),
	teachers_id int,
	date_day varchar(25),
	enter_entry varchar(30),
	enter_exit varchar(30),
	asis_state varchar(20) not null,
	foreign key (teachers_id) references teachers(teachers_id)
);

create table justifications(
	jus_id int primary key identity(1, 1),
	teachers_id int,
	name_jus varchar(255) not null,
	reason_jus varchar(255),
	evidence_jus varchar(255),
	date_jus varchar(30) not null,
	hour_jus time not null
	foreign key (teachers_id) references teachers(teachers_id)
);

create table report(
	report_id int primary key identity(1, 1),
	teachers_id int,
	affair_re varchar(255) not null,
	comment_re varchar(255),
	date_re varchar(30) not null,
	hour_re time not null
	foreign key (teachers_id) references teachers(teachers_id)
);

drop table report

select * from teachers
select * from attendance
select * from justifications
select * from report

update teachers set password_teacher = HASHBYTES('SHA2_512', 'contreras12') where teachers_id = 2

update attendance set asis_state = 'Falto' where asis_id = 2047

delete from attendance where asis_id = 2046

insert into attendance (teachers_id, date_day, enter_entry, enter_exit, asis_state, month_date) values ('1', 'Martes 02/01/24', '7:50:40', '14:15:34', 'Puntual', getDate())

alter table attendance add month_date date;

UPDATE attendance
SET month_date = getdate() WHERE teachers_id = 5;


alter table justifications add month_date date;


