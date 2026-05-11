# Conventions & Standards

## Code Style
- Use TypeScript everywhere
- Strict mode enabled
- No implicit any
- Modular folder structure

## Naming Rules
- camelCase: variables, functions
- PascalCase: classes, DTOs
- kebab-case: file names

## API Standards
- REST-first design
- Versioned endpoints: /api/v1/
- Consistent response format:

{
  "success": true,
  "data": {},
  "error": null
}

## MLM Rules Handling
- NEVER hardcode commission logic in controllers
- Always use Commission Engine service
- All rules must be config-driven

## Security Rules
- Validate all referral inputs
- Prevent self-referral
- Prevent circular referral loops
- Rate limit signup & referral actions