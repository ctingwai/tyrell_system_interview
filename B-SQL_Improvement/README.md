# Improvements

1. In the order by clause, there's a desc in lowercase, though it might not give much performance improvement, but SQL keywords' cases should be consistent due to how DB caching works, MySQL might have cached `ORDER BY Jobs.sort_order desc` but in other parts of the application, it uses `ORDER BY Jobs.sort_order DESC`, so MySQL will cache `ORDER BY Jobs.sort_order DESC` even though they both gives the same result sets.

2. Use `MATCH...AGAINST` instead of `LIKE`, it will give some performance boost, the virtual environment I've created will compare these conditions. However, in my environment, it only gives about 0.3s - 0.8s performance improvement, but the test environment I built only simulates the actual environment partially, it:
  - Does not have the full joins of the table
  - Does not contain all the conditions
  - Does not contain all the fields
  - Limited to 1 row only
  - Loop the query for 250,000,000 times
  It might not be very close to the actual environment, but the results are quite optimistic, it might improve performance by at least 10-15%, given 8s of query, this should redue response time to about 7s or maybe more.
