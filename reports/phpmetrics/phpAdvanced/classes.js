var classes = [
    {
        "name": "phpAdvanced\\Entities\\StatisticRecord",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setId",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTextHash",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTextHash",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStatistic",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setStatistic",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTimestamp",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTimestamp",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getSessionId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setSessionId",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 10,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 5,
        "nbMethodsSetters": 5,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 30,
        "vocabulary": 8,
        "volume": 90,
        "difficulty": 3.33,
        "effort": 300,
        "level": 0.3,
        "bugs": 0.03,
        "time": 17,
        "intelligentContent": 27,
        "number_operators": 10,
        "number_operands": 20,
        "number_operators_unique": 2,
        "number_operands_unique": 6,
        "cloc": 51,
        "loc": 100,
        "lloc": 49,
        "mi": 94.02,
        "mIwoC": 49.31,
        "commentWeight": 44.7,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 5.5,
        "relativeSystemComplexity": 5.5,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 55,
        "totalSystemComplexity": 55,
        "package": "phpAdvanced\\Entities\\",
        "pageRank": 0.52,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "violations": {}
    },
    {
        "name": "phpAdvanced\\Repositories\\TextStatisticsRepository",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "find",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAll",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAllInDateRange",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "create",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 5,
        "nbMethods": 5,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 5,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 5,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "Doctrine\\ORM\\EntityManagerInterface",
            "phpAdvanced\\Entities\\StatisticRecord",
            "phpAdvanced\\Entities\\StatisticRecord"
        ],
        "parents": [],
        "implements": [],
        "lcom": 2,
        "length": 43,
        "vocabulary": 14,
        "volume": 163.72,
        "difficulty": 3.17,
        "effort": 518.43,
        "level": 0.32,
        "bugs": 0.05,
        "time": 29,
        "intelligentContent": 51.7,
        "number_operators": 5,
        "number_operands": 38,
        "number_operators_unique": 2,
        "number_operands_unique": 12,
        "cloc": 10,
        "loc": 40,
        "lloc": 30,
        "mi": 87.11,
        "mIwoC": 52.14,
        "commentWeight": 34.97,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 225,
        "relativeDataComplexity": 0.36,
        "relativeSystemComplexity": 225.36,
        "totalStructuralComplexity": 1125,
        "totalDataComplexity": 1.81,
        "totalSystemComplexity": 1126.81,
        "package": "phpAdvanced\\Repositories\\",
        "pageRank": 0.3,
        "afferentCoupling": 1,
        "efferentCoupling": 2,
        "instability": 0.67,
        "violations": {}
    },
    {
        "name": "phpAdvanced\\Services\\AverageCalculationService",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "perform",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAverageCharactersFrequency",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 1,
        "nbMethodsPublic": 1,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 6,
        "ccn": 5,
        "ccnMethodMax": 4,
        "externals": [
            "Exception"
        ],
        "parents": [],
        "implements": [],
        "lcom": 2,
        "length": 95,
        "vocabulary": 24,
        "volume": 435.57,
        "difficulty": 11.33,
        "effort": 4936.48,
        "level": 0.09,
        "bugs": 0.15,
        "time": 274,
        "intelligentContent": 38.43,
        "number_operators": 27,
        "number_operands": 68,
        "number_operators_unique": 6,
        "number_operands_unique": 18,
        "cloc": 8,
        "loc": 45,
        "lloc": 37,
        "mi": 77.03,
        "mIwoC": 46.64,
        "commentWeight": 30.39,
        "kanDefect": 0.75,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 2,
        "relativeSystemComplexity": 3,
        "totalStructuralComplexity": 2,
        "totalDataComplexity": 4,
        "totalSystemComplexity": 6,
        "package": "phpAdvanced\\Services\\",
        "pageRank": 0.09,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "violations": {}
    },
    {
        "name": "phpAdvanced\\Services\\TextStatisticsService",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "setText",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getText",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTextStatisticsRepository",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTextStatisticsRepository",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "processText",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNumberOfCharacters",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNumberOfWords",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNumberOfSentences",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCharactersFrequency",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCharactersDistributionAsPercentageOfTotal",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAverageWordLength",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAverageNumberOfWordsInSentence",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getMostUsedWords",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLongestWords",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getShortestWords",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLongestSentences",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getShortestSentences",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getNumberOfPalindromes",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLongestPalindromes",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getShortestPalindromes",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "isPalindrome",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getReversed",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getInReversedOrder",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHash",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getWords",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getSentences",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getEachSentenceLength",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getEachPalindromeLength",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getEachWordLengthFromText",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getEachWordLengthFromArray",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getReversedString",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 31,
        "nbMethods": 27,
        "nbMethodsPrivate": 7,
        "nbMethodsPublic": 20,
        "nbMethodsGetter": 2,
        "nbMethodsSetters": 2,
        "wmc": 37,
        "ccn": 11,
        "ccnMethodMax": 3,
        "externals": [
            "phpAdvanced\\Repositories\\TextStatisticsRepository",
            "phpAdvanced\\Repositories\\TextStatisticsRepository"
        ],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 395,
        "vocabulary": 93,
        "volume": 2582.97,
        "difficulty": 27.88,
        "effort": 72025.06,
        "level": 0.04,
        "bugs": 0.86,
        "time": 4001,
        "intelligentContent": 92.63,
        "number_operators": 105,
        "number_operands": 290,
        "number_operators_unique": 15,
        "number_operands_unique": 78,
        "cloc": 49,
        "loc": 281,
        "lloc": 232,
        "mi": 53.16,
        "mIwoC": 23.03,
        "commentWeight": 30.14,
        "kanDefect": 1.58,
        "relativeStructuralComplexity": 841,
        "relativeDataComplexity": 1.15,
        "relativeSystemComplexity": 842.15,
        "totalStructuralComplexity": 26071,
        "totalDataComplexity": 35.53,
        "totalSystemComplexity": 26106.53,
        "package": "phpAdvanced\\Services\\",
        "pageRank": 0.09,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "violations": {}
    }
]