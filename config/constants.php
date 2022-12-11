<?php

//ROLE users
const ROLE_USER = 1;
const ROLE_ADMIN = 2;
const ROLE_SUPER_ADMIN = 3;



//Page id
const ADMIN_PAGE = 1;
const CREATE_ACC_CONFIRMATION_PAGE=2;


//STATUS ACCOUNT
const PAYED=2;
const WAITING_PAY=3;
const CANCELED =4;
const TRIAL=5;
const GIFTED=6;
const USER_ACTIVATED=1;
const USER_SUSPENDED=0;

const STATUSs=[USER_SUSPENDED,USER_ACTIVATED,PAYED,WAITING_PAY,CANCELED,TRIAL,GIFTED];

const REGISTER_REQUEST_EMAIL_TO=[
    'thedung.1292@gmail.com',
    'bdoptimus1292@gmail.com',
];
