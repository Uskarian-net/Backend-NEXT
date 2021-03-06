import passport from 'passport';
import { Router } from 'express';

import RootController from '../../controllers/v1/RootController';

export default () => {
    const routes = Router();

    routes.get('/', passport.authenticate(['bearer', 'anonymous'], {session: false}), RootController.index);

    return routes;
}