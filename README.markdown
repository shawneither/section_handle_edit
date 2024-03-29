Section Handle Edit
===================

Github repo: <https://github.com/neither/section_handle_edit>

## About

A way to edit the section handle separately from the section name.  
Useful for multilingual sites which require non-English section names.

## Credit

This is basically m-r Tarakanoff's old extension with a few bits taken out and files updated to match Symphony 2.3 extension specs.


## Installation

1. Upload the `section_handle_edit` folder to your Symphony `extensions` folder.
2. Enable it by selecting the "Section Handle Edit" under System -> Extensions, choose Enable from the 'with-selected' menu and click Apply.
3. A new field 'Handle' will be added to the Section Editor form.


## Usage

When creating a new section or editing an existing one, you can specify the section handle separately from the section name.  
If you input a handle which already exists for another section, the handle will be forced back to the default sanitized version of your section name.  
Be careful to only input 'handle-ized' handles, ie: no spaces or punctuation other than dashes (`-`), no non-latin characters, all lowercase.  


## To Do

* Catch and output errors on handle creation and editing:
	* handle already exists in other section
	* handle must be 'handle-ized'
