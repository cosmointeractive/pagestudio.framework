
Authentication
======================================

.. contents::
   :local:
   :depth: 1

Overview
##### 

To authenticate your app, all you will need to do is request your secret API key 
from us. Then authenticate your account when using the API by including your secret 
API key in the request. 

.. important:: Be sure to not share your API keys in public forums, or give them to anyone as they will be able to access all your account informations.
   
Example
******

:: 

    curl -H "Accept: application/json" \
    https://app.solutionsitw.com/api/cxm/<method> \
    -u {API_KEY}:

Troubleshooting/FAQ
###################

More information coming soon!

And some more... 

.. toctree::
   :maxdepth: 2