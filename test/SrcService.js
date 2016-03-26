[{
	"name": {
		"parts": ["ModuleTestTest", "ServiceTest"***REMOVED***
	},
	"stmts": [{
		"type": 1,
		"uses": [{
			"type": 0,
			"name": {
				"parts": ["GearBaseTest", "AbstractTestCase"***REMOVED***
			},
			"alias": "AbstractTestCase"
		}***REMOVED***
	}, {
		"type": 1,
		"uses": [{
			"type": 0,
			"name": {
				"parts": ["ModuleTest", "Service", "CreateSrcTrait"***REMOVED***
			},
			"alias": "CreateSrcTrait"
		}***REMOVED***
	}, {
		"type": 0,
		"extends": {
			"parts": ["AbstractTestCase"***REMOVED***
		},
		"implements": [***REMOVED***,
		"name": "CreateSrcTest",
		"stmts": [{
			"traits": [{
				"parts": ["CreateSrcTrait"***REMOVED***
			}***REMOVED***,
			"adaptations": [***REMOVED***
		}, {
			"type": 1,
			"byRef": false,
			"name": "testServiceLocator",
			"params": [***REMOVED***,
			"returnType": null,
			"stmts": [{
				"var": {
					"name": "serviceLocator"
				},
				"expr": {
					"var": {
						"var": {
							"name": "this"
						},
						"name": "getCreateSrc",
						"args": [***REMOVED***
					},
					"name": "getServiceLocator",
					"args": [***REMOVED***
				}
			}, {
				"var": {
					"name": "this"
				},
				"name": "assertInstanceOf",
				"args": [{
					"value": {
						"value": "Zend\\ServiceManager\\ServiceManager"
					},
					"byRef": false,
					"unpack": false
				}, {
					"value": {
						"name": "serviceLocator"
					},
					"byRef": false,
					"unpack": false
				}***REMOVED***
			}***REMOVED***
		}, {
			"type": 1,
			"byRef": false,
			"name": "testGet",
			"params": [***REMOVED***,
			"returnType": null,
			"stmts": [{
				"var": {
					"name": "createSrc"
				},
				"expr": {
					"var": {
						"name": "this"
					},
					"name": "getCreateSrc",
					"args": [***REMOVED***
				}
			}, {
				"var": {
					"name": "this"
				},
				"name": "assertInstanceOf",
				"args": [{
					"value": {
						"value": "ModuleTest\\Service\\CreateSrc"
					},
					"byRef": false,
					"unpack": false
				}, {
					"value": {
						"name": "createSrc"
					},
					"byRef": false,
					"unpack": false
				}***REMOVED***
			}***REMOVED***
		}, {
			"type": 1,
			"byRef": false,
			"name": "testSet",
			"params": [***REMOVED***,
			"returnType": null,
			"stmts": [{
				"var": {
					"name": "mockCreateSrc"
				},
				"expr": {
					"var": {
						"name": "this"
					},
					"name": "getMockSingleClass",
					"args": [{
						"value": {
							"value": "ModuleTest\\Service\\CreateSrc"
						},
						"byRef": false,
						"unpack": false
					}***REMOVED***
				}
			}, {
				"var": {
					"name": "this"
				},
				"name": "setCreateSrc",
				"args": [{
					"value": {
						"name": "mockCreateSrc"
					},
					"byRef": false,
					"unpack": false
				}***REMOVED***
			}, {
				"var": {
					"name": "this"
				},
				"name": "assertEquals",
				"args": [{
					"value": {
						"name": "mockCreateSrc"
					},
					"byRef": false,
					"unpack": false
				}, {
					"value": {
						"var": {
							"name": "this"
						},
						"name": "getCreateSrc",
						"args": [***REMOVED***
					},
					"byRef": false,
					"unpack": false
				}***REMOVED***
			}***REMOVED***
		}***REMOVED***
	}***REMOVED***
}***REMOVED***