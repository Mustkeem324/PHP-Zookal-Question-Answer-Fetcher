# README

## Description
This PHP script is designed to fetch question and answer data from the Zookal website's API. It takes a URL as a GET parameter, extracts the question's slug from the URL, and then sends a GET request to the Zookal API to retrieve the question and answer content. The fetched data is then saved into an HTML file for later reference. If the answer is successfully fetched, it is displayed on the web page; otherwise, an error message is shown.

## How to Use
1. Ensure you have a PHP environment set up.
2. Place the provided PHP code into a PHP file in your web server's directory.
3. Make sure you have a `cookieszookal.txt` file containing the necessary authorization token.
4. Access the script via a web browser, providing a URL parameter (`?url=`) with the Zookal question URL you want to fetch.

## Dependencies
- cURL: The script uses cURL to send HTTP requests to the Zookal API.

## File Structure
- **zookalanswer**: This directory stores the fetched question and answer HTML files.
- **index.php**: The main PHP script file.

## Security Considerations
- Ensure that the `cookieszookal.txt` file containing the authorization token is securely stored and not accessible to unauthorized users.
- Sanitize and validate user input to prevent potential security vulnerabilities such as XSS attacks or injection attacks.

## Contact
For any issues or inquiries regarding this script, please contact the owner:
- Owner Name: NX
- Owner Telegram Link: [https://t.me/CheggbyTnTbot](https://t.me/CheggbyTnTbot)
