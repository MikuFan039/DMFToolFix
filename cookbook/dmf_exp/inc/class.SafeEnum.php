<?php

/**
 * Class Enum
 * 
 * @author Christopher Fox <christopher.fox@gmx.de>
 *
 * @version 1.0
 *
 * This class provides the function of an enumeration.
 * The values of Enum elements are unique (even between different Enums)
 * as you would expect them to be.
 *
 * Constructing a new Enum:
 * ========================
 *
 * In the following example we construct an enum called "UserState"
 * with the elements "inactive", "active", "banned" and "deleted".
 * 
 * <code>
 * Enum::Create('UserState', 'inactive', 'active', 'banned', 'deleted');
 * </code>
 *
 * Using Enums:
 * ============
 *
 * The following example demonstrates how to compare two Enum elements
 *
 * <code>
 * var_dump(UserState::inactive == UserState::banned); // result: false
 * var_dump(UserState::active == UserState::active); // result: true
 * </code>
 *
 * Special Enum methods:
 * =====================
 *
 * Get the number of elements in an Enum:
 *
 * <code>
 * echo UserState::CountEntries(); // result: 4
 * </code>
 *
 * Get a list with all elements of the Enum:
 *
 * <code>
 * $allUserStates = UserState::GetEntries();
 * </code>
 *
 * Get a name of an element:
 *
 * <code>
 * echo UserState::GetName(UserState::deleted); // result: deleted
 * </code>
 *
 * Get an integer ID for an element (e.g. to store as a value in a database table):
 * This is simply the index of the element (beginning with 1).
 * Note that this ID is only unique for this Enum but now between different Enums.
 *
 * <code>
 * echo UserState::GetDatabaseID(UserState::active); // result: 2
 * </code>
 */
class SafeEnum
{

    /**
     * @var Enum $instance The only instance of Enum (Singleton)
     */
    private static $instance;

    /**
     * @var array $enums    An array of all enums with Enum names as keys
     *          and arrays of element names as values
     */
    private $enums;

    /**
     * Constructs (the only) Enum instance
     */
    private function __construct()
    {
        $this->enums = array();
    }

    /**
     * Constructs a new enum
     *
     * @param string $name The class name for the enum
     * @param mixed $_ A list of strings to use as names for enum entries
     */
    public static function Create($name, $_)
    {
        // Create (the only) Enum instance if this hasn't happened yet
        if (self::$instance===null)
        {
            self::$instance = new SafeEnum();
        }

        // Fetch the arguments of the function
        $args = func_get_args();
        // Exclude the "name" argument from the array of function arguments,
        // so only the enum element names remain in the array
        array_shift($args);
        self::$instance->add($name, $args);
    }

    /**
     * Creates an enumeration if this hasn't happened yet
     * 
     * @param string $name The class name for the enum
     * @param array $fields The names of the enum elements
     */
    private function add($name, $fields)
    {
        if (!array_key_exists($name, $this->enums))
        {
            $this->enums[$name] = array();

            // Generate the code of the class for this enumeration
            $classDeclaration =     "class " . $name . " {\n"
                        . "private static \$name = '" . $name . "';\n"
                        . $this->getClassConstants($name, $fields)
                        . $this->getFunctionGetEntries($name)
                        . $this->getFunctionCountEntries($name)
                        . $this->getFunctionGetDatabaseID()
                        . $this->getFunctionGetName()
                        . "}";

            // Create the class for this enumeration
            eval($classDeclaration);
        }
    }

    /**
     * Returns the code of the class constants
     * for an enumeration. These are the representations
     * of the elements.
     * 
     * @param string $name The class name for the enum
     * @param array $fields The names of the enum elements
     *
     * @return string The code of the class constants
     */
    private function getClassConstants($name, $fields)
    {
        $constants = '';

        foreach ($fields as $field)
        {
            // Create a unique ID for the Enum element
            // This ID is unique because class and variables
            // names can't contain a semicolon. Therefore we
            // can use the semicolon as a separator here.
            $uniqueID = $name . ";" . $field;
            $constants .=   "const " . $field . " = '". $uniqueID . "';\n";
            // Store the unique ID
            array_push($this->enums[$name], $uniqueID);
        }

        return $constants;
    }

    /**
     * Returns the code of the function "GetEntries()"
     * for an enumeration
     * 
     * @param string $name The class name for the enum
     *
     * @return string The code of the function "GetEntries()"
     */
    private function getFunctionGetEntries($name) 
    {
        $entryList = '';        

        // Put the unique element IDs in single quotes and
        // separate them with commas
        foreach ($this->enums[$name] as $key => $entry)
        {
            if ($key > 0) $entryList .= ',';
            $entryList .= "'" . $entry . "'";
        }

        return  "public static function GetEntries() { \n"
            . " return array(" . $entryList . ");\n"
            . "}\n";
    }

    /**
     * Returns the code of the function "CountEntries()"
     * for an enumeration
     * 
     * @param string $name The class name for the enum
     *
     * @return string The code of the function "CountEntries()"
     */
    private function getFunctionCountEntries($name) 
    {
        // This function will simply return a constant number (e.g. return 5;)
        return  "public static function CountEntries() { \n"
            . " return " . count($this->enums[$name]) . ";\n"
            . "}\n";
    }

    /**
     * Returns the code of the function "GetDatabaseID()"
     * for an enumeration
     * 
     * @return string The code of the function "GetDatabaseID()"
     */
    private function getFunctionGetDatabaseID()
    {
        // Check for the index of this element inside of the array
        // of elements and add +1
        return  "public static function GetDatabaseID(\$entry) { \n"
            . "\$key = array_search(\$entry, self::GetEntries());\n"
            . " return \$key + 1;\n"
            . "}\n";
    }

    /**
     * Returns the code of the function "GetName()"
     * for an enumeration
     *
     * @return string The code of the function "GetName()"
     */
    private function getFunctionGetName()
    {
        // Remove the class name from the unique ID 
        // and return this value (which is the element name)
        return  "public static function GetName(\$entry) { \n"
            . "return substr(\$entry, strlen(self::\$name) + 1 , strlen(\$entry));\n"
            . "}\n";
    }

}
