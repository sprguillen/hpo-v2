/**
 * BE CAREFUL! DO NOT INCLUDE THIS ON COMMIT
 * You will be changing the CLIENT_ID AND SECRET
 * if there you had just setup passport. The values
 * of this varies from different environments/setups
 * that is why it's not advisable to commit this.
 */
export const CLIENT_ID = process.env.MIX_CLIENT_ID;
export const CLIENT_SECRET = process.env.MIX_CLIENT_SECRET;
export const GRANT_TYPE = process.env.MIX_GRANT_TYPE;