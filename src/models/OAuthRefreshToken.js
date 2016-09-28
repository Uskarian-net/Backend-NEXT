import User from './User';
import { Model } from 'objection';
import BaseModel from './BaseModel';
import OAuthClient from './OAuthClient';

class OAuthRefreshToken extends BaseModel {
    static tableName = 'oauth_refresh_tokens';

    static jsonSchema = {
        type: 'object',

        required: ['user_id', 'client_id', 'authorization_code', 'redirect_uri', 'expires_at'],

        properties: {
            id: {type: 'integer'},
            user_id: {type: 'integer', minimum: 1},
            client_id: {type: 'integer', minimum: 1},
            refresh_token: {type: 'string'},
            created_at: {type: ['string', 'null'], format: 'date-time', default: null},
            updated_at: {type: ['string', 'null'], format: 'date-time', default: null},
            expires_at: {type: ['string', 'null'], format: 'date-time', default: null}
        }
    };

    static relationMappings = {
        client: {
            relation: Model.BelongsToOneRelation,
            modelClass: OAuthClient,
            join: {
                from: 'oauth_refresh_tokens.user_id',
                to: 'oauth_clients.id'
            }
        },
        user: {
            relation: Model.BelongsToOneRelation,
            modelClass: User,
            join: {
                from: 'oauth_refresh_tokens.client_id',
                to: 'users.id'
            }
        }
    };
}

export default OAuthRefreshToken;