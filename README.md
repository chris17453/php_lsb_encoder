# TransliminalDataGif

TransliminalDataGif is a PHP class designed to create GIF images from raw data. It converts input data into GIF frames and saves them as output files.

## Usage

1. **Instantiate the class**: Create an instance of the `transliminalDataGif` class with the necessary parameters: input file path, output file path, width, height, and density.

2. **Initialize colors**: The `createPalette` function initializes the color palette for the GIF.

3. **Create frames**: The `createFrame` function generates a frame structure based on the specified width, height, and density. It returns the amount of free space available in the frame.

4. **Fill frames**: Use the `fillFrame` function to fill the frame with data read from the input file.

5. **Save frames**: The `saveFrame` function creates and saves the GIF frame as an output file.

## Methods

- `transliminalDataGif($input, $output, $width, $height, $density)`: Constructor function to initialize the class and create GIF frames.

- `createPalette()`: Initializes the color palette for the GIF.

- `createFrame()`: Generates a frame structure based on the specified width, height, and density.

- `fillFrame($data)`: Fills the frame with data read from the input file.

- `saveFrame()`: Creates and saves the GIF frame as an output file.

## Example

```php
$inputFile = "input.txt";
$outputFile = "output.gif";
$width = 320;
$height = 240;
$density = 4;

$gif = new transliminalDataGif($inputFile, $outputFile, $width, $height, $density);
```

## Requirements

- PHP 5.6+

## License

This project is licensed under the BSD 3 License - see the [LICENSE](LICENSE) file for details.
