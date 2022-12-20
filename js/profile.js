var downContact = document.querySelector("#back-to-top");

var vcfStructure = `
BEGIN:VCARD
VERSION:3.0
PRODID:-//Apple Inc.//iPhone OS 9.2.1//EN
N:${LastName};${FirstName};;;
FN: Zintech
ORG: ${slogan};
TEL;type=${typePhone};type=VOICE;type=pref:${phone}
END:VCARD
`; 

var encodeVcf = btoa(vcfStructure);
function downloadCSV() {
  var vcf = `data:text/x-vcard;charset=utf-8;base64,${encodeVcf}`; //Creates CSV File Format
  var excel = encodeURI(vcf); //Links to vcf
  var link = document.createElement("a");
  link.setAttribute("href", excel); //Links to vcf File
  link.setAttribute("download", "test.vcf"); //Filename that vcf is saved as
  link.click();
}

downContact.addEventListener("click", downloadCSV);
