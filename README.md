
<pre>
auth_client:
  auth:
    resource_owner: '%env(OAUTH_RESOURCE_OWNER)%'
    client_id: '%env(OAUTH_CLIENT_ID)%'
    client_secret: '%env(OAUTH_CLIENT_SECRET)%'
    redirect_uris: '%env(resolve:OAUTH_REDIRECT_URI)%'
    response_type: '%env(OAUTH_RESPONSE_TYPE)%'
    grant_type: '%env(OAUTH_GRAN_TYPE)%'
    scope: 'w r'
    host_client:
        host: '%env(resolve:OAUTH_URL)%'
        port: 8080
</pre>

<pre>
<h2>Fluxograma</h2>
<img src="https://lucid.app/lucidchart/invitations/accept/inv_c55e36fb-c732-4a20-bcb3-926d40f9b5bb" title="fluxograma"/>
</pre>
