
Errors
======================================

.. contents::
   :local:
   :depth: 1

Our API uses ``HTTP response codes`` to indicate API errors. All responses are returned in JSON, including errors. 
Commonly, codes in the ``2xx`` range indicate success, codes in the ``4xx`` range indicate an error that failed 
due to incorrect information provided (e.g., a required parameter was omitted, etc.), and codes in the ``5xx`` range indicate a server (endpoint) error. 

Success codes
########

    * 200 - OK (the default)
    * 201 - Created
    * 202 - Accepted (often used for delete requests)

User error codes
########

    * 400 - Bad Request (generic user error/bad data)
    * 401 - Unauthorized (this area requires you to log in)
    * 404 - Not Found (bad URL)
    * 405 - Method Not Allowed (wrong HTTP method)
    * 409 - Conflict (i.e. trying to create the same resource with a PUT request)

.. toctree::
   :maxdepth: 2