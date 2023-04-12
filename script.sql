create database shop;
use shop;

create table usuarios(
id int not null auto_increment primary key,
nome varchar(140) not null,
nascimento date not null,
telefone varchar(140) not null,
email varchar(140) not null,
senha varchar(140) not null,
foto varchar(255),
data_criacao DateTime not null,
data_alteracao DateTime);

create table produtos(
id int not null auto_increment primary key,
nome varchar(140) not null,
descricao varchar(140) not null,
preco float not null ,
img varchar(255) not null,
img1 varchar(255) not null,
img2 varchar(255) not null,
img3 varchar(255) not null,
data_criacao DateTime not null,
data_alteracao DateTime);

create table produtos_recomendados(
id int not null auto_increment primary key,
nome varchar(140) not null,
sequencia int not null,
img varchar(255) not null);

create table carrinho(
id int not null auto_increment primary key,
id_usuario int not null,
id_produto int,
quantidade int,
foreign key (id_usuario) references usuarios(id),
foreign key (id_produto) references produtos(id));

create table pedido(
id int not null auto_increment primary key,
id_usuario int null,
foreign key (id_usuario) references usuarios(id));

create table pedido_item(
id int not null auto_increment primary key,
id_pedido int not null,
id_produto int not null,
foreign key (id_pedido) references pedido(id),
foreign key (id_produto) references produtos(id),
quantidade int not null,
preco float not null);


create table favorito(
id int not null auto_increment primary key,
id_usuario int not null,
id_produto int not null,
foreign key (id_usuario) references usuarios(id),
foreign key (id_produto) references produtos(id));

insert into usuarios(nome, nascimento, telefone, email, senha, data_criacao, data_alteracao, foto) values("Administrador", now(), "xxxxxxxxxxx", "admin@admin.com", "admin", now(), null, null);