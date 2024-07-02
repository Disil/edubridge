(context: mysql) lets say i have a table called table_a with columns: id_users|A|B|C and i have anther table called table_b with columns: id_users|D|E|F.

Now, i create another table called table_combined with columns: id_users|A|B|C|D|E|F. Can i put table_a & table_b content to table_combined at different times? And be sure to include it with a row that is have a same id_user

You want to combine the data from table_a and table_b into table_combined, but you want to do it in two separate steps, and ensure that the data is matched based on the id_users column.

The answer is yes, you can do this using MySQL's INSERT INTO statement with a SELECT clause.

Here's an example of how you can do it:

Step 1: Insert data from table_a into table_combined

    sql

INSERT INTO table_combined (id_users, A, B, C, D, E, F)

SELECT ta.id_users, ta.A, ta.B, ta.C, NULL, NULL, NULL

FROM table_a ta;

This will insert all the data from table_a into table_combined, with NULL values for columns D, E, and F.

    Step 2: Insert data from table_b into table_combined, matching on id_users

    sql

INSERT INTO table_combined (id_users, D, E, F)

SELECT tb.id_users, tb.D, tb.E, tb.F

FROM table_b tb

WHERE tb.id_users IN (SELECT id_users FROM table_combined);

This will insert the data from table_b into table_combined, but only for the id_users that already exist in table_combined. The WHERE clause ensures that we only insert data for users that were already inserted in Step 1.

    Note that in Step 2, we're only inserting values for columns D, E, and F, since the other columns were already populated in Step 1.

By doing it in two separate steps, you can ensure that the data is matched correctly based on the id_users column.