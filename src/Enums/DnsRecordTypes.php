<?php

namespace Spits\LaravelOpenproviderApi\Enums;

enum DnsRecordTypes: string
{
    // Order of these records is resembling the select box in Openprovider portal
    case A = 'A';
    case AAAA = 'AAAA';
    case CAA = 'CAA';
    case CNAME = 'CNAME';
    case MX = 'MX';
    case SOA = 'SOA';
    case SPF = 'SPF';
    case SRV = 'SRV';
    case SSHFP = 'SSHFP';
    case TLSA = 'TLSA';
    case TXT = 'TXT';
    case NS = 'NS';
}
