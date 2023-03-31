create database shop;
use shop;

create table usuarios(
id int not null auto_increment primary key,
nome varchar(140) not null,
nascimento date not null,
telefone varchar(140) not null,
email varchar(140) not null,
senha varchar(140) not null,
foto blob,
data_criacao DateTime not null,
data_alteracao DateTime);

create table produtos(
id int not null auto_increment primary key,
nome varchar(140) not null,
descricao varchar(140) not null,
preco float not null ,
img blob not null,
img1 blob not null,
img2 blob not null,
img3 blob not null,
data_criacao DateTime not null,
data_alteracao DateTime);

create table carrinho(
id int not null auto_increment primary key,
id_usuario int not null,
id_produto int,
foreign key (id_usuario) references usuarios(id),
foreign key (id_produto) references produtos(id));

create table pedido(
id int not null auto_increment primary key,
id_usuario int null,
foreign key (id_usuario) references usuarios(id));

create table pedido_item(
id int not null auto_increment primary key,
id_pedido int not null,
id_produto int not null);

insert into usuarios(nome, nascimento, telefone, email, senha, data_criacao, data_alteracao, foto) values("Administrador", now(), "xxxxxxxxxxx", "admin@admin.com", "admin", now(), null, null);