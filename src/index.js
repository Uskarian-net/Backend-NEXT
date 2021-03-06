import http from 'http';
import cors from 'cors';
import helmet from 'helmet';
import logger from 'morgan';
import express from 'express';
import passport from 'passport';
import { Model } from 'objection';
import flash from 'connect-flash';
import compress from 'compression';
import bodyParser from 'body-parser';
import session from 'express-session';
import cookieParser from 'cookie-parser';
import responseTime from 'response-time';
import ConnectSessionKnex from 'connect-session-knex';

import knex from '../db';
import routes from './routes';
import middleware from './middleware';
import { environment, getConfig } from '../config';

const config = getConfig();
const KnexSessionStore = new ConnectSessionKnex(session);
const sessionStore = new KnexSessionStore({
    tablename: 'sessions',
    createtable: false,
    knex
});

let app = express();
app.server = http.createServer(app);

// response time headers
app.use(responseTime({
    suffix: false
}));

// setup sessions
app.use(session({
    ...config.session,
    store: sessionStore
}));

Model.knex(knex);

// setup view engine and static
app.set('view engine', 'ejs');
app.set('views', __dirname + '/views');
app.use(flash());
app.use(express.static(__dirname + '/public'));

// 3rd party middleware
app.use(cors());
app.use(helmet());
app.use(compress());
app.use(cookieParser());
app.use(bodyParser.json({type: 'application/*+json'}));
app.use(bodyParser.urlencoded({type: 'application/x-www-form-urlencoded', extended: true}));

// OAuth
app.use(passport.initialize());
app.use(passport.session());
require('./auth');

if (environment === 'development') {
    app.use(logger('dev'));
}

// internal middleware
app.use(middleware());

// routes
routes(app);

app.server.listen(process.env.PORT || config.port);

if (environment !== 'test') {
    console.log(`Started on port ${app.server.address().port}`);
}

export default app;
