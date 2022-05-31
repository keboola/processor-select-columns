# processor-select-columns

[![Build Status](https://travis-ci.org/keboola/processor-select-columns.svg?branch=master)](https://travis-ci.org/keboola/processor-select-columns)

Takes all tables in `/data/in/tables` and selects the specified set of columns from the files the tables to `/data/out/tables`. 

 - Does not ignores directory structure (for sliced files).
 - Updates manifest file.

## Prerequisites

All CSV files must

- not have headers
- have a manifest file with `columns`, `delimiter` and `enclosure` properties
 
## Usage
Supports optional parameters:

- `columns` -- Array of selected columns


### Sample configurations

Select columns `col1` and `col2`:

```
{
    "definition": {
        "component": "keboola.processor-select-columns"
    },
    "parameters": {
    	"columns": ["col1", "col2"]
	}
}

```
 
## Development
 
Clone this repository and init the workspace with following command:

```
git clone https://github.com/keboola/processor-select-columns
cd processor-select-columns
docker-compose build
docker-compose run dev composer install
```

Run the test suite using this command:

```
docker-compose run tests
```
 
## Integration
 - Build is started after push on [Travis CI](https://travis-ci.org/keboola/processor-select-columns)
 - [Build steps](https://github.com/keboola/processor-select-columns/blob/master/.travis.yml)
   - build image
   - execute tests against new image
   - publish image to ECR if release is tagged
   

## License

MIT licensed, see [LICENSE](./LICENSE) file.
