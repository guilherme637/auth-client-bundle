<pre>
auth_client:
  auth:
    resource_owner: '%env(OAUTH_RESOURCE_OWNER)%'
    client_id: '%env(OAUTH_CLIENT_ID)%'
    client_secret: '%env(OAUTH_CLIENT_SECRET)%'
    host_client: '%env(resolve:OAUTH_URL)%'
    redirect_uris: '%env(resolve:OAUTH_REDIRECT_URI)%'
    response_type: '%env(OAUTH_RESPONSE_TYPE)%'
    grant_type: '%env(OAUTH_GRAN_TYPE)%'
    scope: 'w r'
</pre>