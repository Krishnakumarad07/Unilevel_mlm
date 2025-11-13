# Unilevel_mlm implemet commission system..
| id | username | referral_code | referred_by | level | total_referrals |
| -- | -------- | ------------- | ----------- | ----- | --------------- |
| 1  | admin1   | ADMIN1        | NULL        | 0     | 2               |
| 2  | user1    | IH4HIP        | 1           | 1     | 2               |
| 3  | user2    | 2VQLLW        | 1           | 1     | 2               |
| 4  | user3    | OWL57I        | 2           | 2     | 0               |
| 5  | user4    | ZIKPZN        | 2           | 2     | 0               |
| 6  | user5    | LKTLYJ        | 3           | 2     | 0               |
| 7  | user6    | 9MKO3R        | 3           | 2     | 1               |
| 8  | user7    | ULEIZ2        | 7           | 3     | 1               |
| 9  | user8    | 5IWS5X        | 8           | 4     | 1               |
| 10 | user9    | 1FYCRG        | 9           | 5     | 0               |

Admin (id=1)
├── user1 (id=2)
│   ├── user3 (id=4)
│   └── user4 (id=5)
└── user2 (id=3)
    ├── user5 (id=6)
    └── user6 (id=7)
        └── user7 (id=8)
            └── user8 (id=9)
                └── user9 (id=10)

| id | user_id | from_user_id | amount | level |
| -- | ------- | ------------ | ------ | ----- |
| 1  | 3       | 7            | 10.00  | 1     |
| 2  | 1       | 7            | 5.00   | 2     |
| 3  | 9       | 10           | 100.00 | 1     |
| 4  | 8       | 10           | 50.00  | 2     |
| 5  | 7       | 10           | 30.00  | 3     |
| 6  | 3       | 10           | 20.00  | 4     |
| 7  | 1       | 10           | 10.00  | 5     |
