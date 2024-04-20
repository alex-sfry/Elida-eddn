<?php

namespace Core\Helper;

use JsonSchema\Validator;

/**
 * Class SchemaValidator
 *  Validates jsons against different schemas
 */
class SchemaValidator
{
    /**
     * @param Validator $validator
     * @param string $json
     * @return bool
     */
    public function validateCommodities(Validator $validator, string $json): bool
    {
        $data = json_decode($json);
        $validator->validate($data, (object)['$ref' => 'file://' . realpath('commodities_shema.json')]);

        if ($validator->isValid()) {
            echo "The supplied JSON validates against the COMMODITIES schema.\n";
            return true;
            // file_put_contents('price2.json', $message);
            // die;
        } else {
            // echo "JSON does not validate. Violations:\n";
            return false;
        }
    }

    /**
     * @param \JsonSchema\Validator $validator
     * @param string $json
     *
     * @return bool
     */
    public function validateJournal(Validator $validator, string $json): bool
    {
        $data = json_decode($json);
        $validator->validate($data, (object)['$ref' => 'file://' . realpath('journal_schema.json')]);

        if ($validator->isValid()) {
            echo "The supplied JSON validates against the JOURNALS schema.\n";

            if ($data->message->event === 'Docked') {
                echo "Docked\n";
                file_put_contents('journal.json', $json, FILE_APPEND);
            }

            return true;
        } else {
            // echo "JSON does not validate. Violations:\n";
            return false;
        }
    }

    /**
     * @param \JsonSchema\Validator $validator
     * @param string $json
     *
     * @return bool
     */
    public function validateOutfitting(Validator $validator, string $json): bool
    {
        $data = json_decode($json);
        $validator->validate($data, (object)['$ref' => 'file://' . realpath('outfitting_schema.json')]);

        if ($validator->isValid()) {
            echo "The supplied JSON validates against the OUTFITTING schema.\n";
            // file_put_contents('outfitting.json', $json, FILE_APPEND);

            return true;
        } else {
            // echo "JSON does not validate. Violations:\n";
            return false;
        }
    }

    /**
     * @param \JsonSchema\Validator $validator
     * @param string $json
     *
     * @return bool
     */
    public function validateShipyard(Validator $validator, string $json): bool
    {
        $data = json_decode($json);
        $validator->validate($data, (object)['$ref' => 'file://' . realpath('shipyard_schema.json')]);

        if ($validator->isValid()) {
            echo "The supplied JSON validates against the SHIPYARD schema.\n";
            // file_put_contents('shipyard.json', $json, FILE_APPEND);

            // if ($data->message->event === 'Docked') {
            //     echo "Docked\n";
            //     file_put_contents('journal.json', $json, FILE_APPEND);
            // }

            return true;
        } else {
            // echo "JSON does not validate. Violations:\n";
            return false;
        }
    }
}
