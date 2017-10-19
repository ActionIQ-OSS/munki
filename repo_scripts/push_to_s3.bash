#!/bin/bash

# pushes the munki repo 
aws s3 sync ~/munki_repo/ s3://aiq-munki-repo/ --exclude '*.git/*' --exclude '.DS_Store'