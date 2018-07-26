create table access
(
  id         int auto_increment
    primary key,
  access_key varchar(32) not null,
  constraint access_access_key_uindex
  unique (access_key)
);

create table admin
(
  id       int auto_increment
    primary key,
  username varchar(32)     null,
  password varchar(32)     null,
  staff    int default '1' null,
  constraint admin_username_uindex
  unique (username),
  constraint admin_password_uindex
  unique (password)
);

create table category
(
  cat_id    int auto_increment
    primary key,
  cat_name  varchar(40)  not null,
  cat_image varchar(255) not null
)
  engine = InnoDB;

create table devices
(
  device_id   int auto_increment
    primary key,
  table_name  varchar(30)  not null,
  mac_address varchar(255) not null,
  constraint devices_table_name_uindex
  unique (table_name),
  constraint devices_mac_address_uindex
  unique (mac_address)
)
  engine = InnoDB;

create table food
(
  food_id          int auto_increment
    primary key,
  cat_id           int(20)         not null,
  food_name        varchar(32)     not null,
  food_image       varchar(255)    not null,
  food_price       decimal         not null,
  food_description varchar(500)    not null,
  status           int default '1' null,
  constraint food_food_name_uindex
  unique (food_name)
)
  engine = InnoDB;

create table orders
(
  order_id      int(15) auto_increment
    primary key,
  food_id       int(15)                             not null,
  food_name     varchar(50)                         not null,
  food_quantity int(15)                             not null,
  item_price    int(15)                             not null,
  total_price   int(10)                             not null,
  user_phone    varchar(50)                         not null,
  status        int                                 null,
  mac_address   varchar(80)                         not null,
  ordered_at    timestamp default CURRENT_TIMESTAMP null
)
  engine = InnoDB;

create table user
(
  user_id       int auto_increment
    primary key,
  user_phone    varchar(15) not null,
  user_name     varchar(20) not null,
  user_password varchar(32) not null
)
  engine = InnoDB;

