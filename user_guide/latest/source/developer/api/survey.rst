
Survey
======================================

.. contents::
   :local:
   :depth: 1

Overview
##### 

More information coming!

Submitting a survey
########

To submit a survey you may only use a ``POST`` method. 
You must also specify the following in the header ``application/json`` and ``application/x-www-form-urlencoded``.
Don't forget to include your secret API key in the header as well.

The URL path is ``api/survey/{param1}/{param2}``.

URL Parameters
******

+--------------------+--------------------------------------------------------------------+
| Key                | Required    | Type     | Example      | Description                |
+--------------------+--------------------------------------------------------------------+
| entries            | true        | string   |              |                            |
+--------------------+--------------------------------------------------------------------+
| get                | true        | string   |              |                            |
+--------------------+--------------------------------------------------------------------+
| create             |             |          |              |                            |
+--------------------+--------------------------------------------------------------------+

 
Example
******

The URL **endpoint** is ``api/survey/entries``.

:: 

    curl -d "store_id=value1&device_id=value2&location_id=value1&survery_id=value2&question 1=answer to the first question" -X POST http://.../api/survey/data
    
Response
*******

.. code-block:: php

    {
      "store_id": 123456,
      "device_id": 123456,
      "location_id" : 123456,
      "survery_id": 123456,
      "data": [
        {
          "question 1": "answer to the first question",
          "question 2": "answer to the second question"
        }
      ],
      "ts" : 1272508903
    }
    

Troubleshooting/FAQ
###################

More information coming soon!

.. toctree::
   :maxdepth: 2