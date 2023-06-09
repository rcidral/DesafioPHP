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
data_alteracao DateTime,
delected tinyint default false);

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
data_alteracao DateTime,
delected tinyint default false);

create table carrinho(
id int not null auto_increment primary key,
id_usuario int not null,
id_produto int,
quantidade int,
foreign key (id_usuario) references usuarios(id),
foreign key (id_produto) references produtos(id));

create table pedido(
id int not null auto_increment primary key,
id_usuario int not null);

create table pedido_item(
id int not null auto_increment primary key,
id_produto int not null,
quantidade int not null,
preco float not null);

create table pedido_has_pedido_item(
id int not null auto_increment primary key,
id_pedido int not null,
id_pedido_item int not null,
foreign key (id_pedido) references pedido(id),
foreign key (id_pedido_item) references pedido_item(id));

create table produtos_recomendados(
id int not null auto_increment primary key,
nome varchar(140) not null,
sequencia int not null,
img varchar(255) not null);

create table favorito(
id int not null auto_increment primary key,
id_usuario int not null,
id_produto int not null);

create table info(
id int not null auto_increment primary key,
slack_url varchar(255) null,
wpp_url varchar(255) null,
secret_key varchar(255) null,
public_token varchar(255) null,
device_token varchar(255) null,
auth nvarchar(1000) null);

insert into usuarios(nome, nascimento, telefone, email, senha, data_criacao, data_alteracao, foto) values("Administrador", now(), "xxxxxxxxxxx", "admin@admin.com", "admin", now(), null, null);