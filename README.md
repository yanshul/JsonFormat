# JsonFormat
In some cases the browser doesn't support JavaScript so we end up sending the profile data as
the following query string:
profile|73241232|<Aamir><Hussain><Khan>|<Mumbai><<72.872075><19.075606>>|73241
232.jpg**followers|54543342|<Anil><><Kapoor>|<Delhi><<23.23><12.07>>|54543342.
jpg@@|12311334|<Amit><><Bansal>|<Bangalore><<><>>|12311334.jpg
Your task is to generate the JSON by parsing the above query string, it should look like same as
the JSON mentioned in the question.
Another example of the query string:
