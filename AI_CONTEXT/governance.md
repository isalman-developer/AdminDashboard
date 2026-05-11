# AI Context Governance System

## Purpose
This file defines how AI models must maintain, update, and evolve the AI_CONTEXT system as the project grows.

The system is "living" and must evolve with new features, modules, and architectural decisions—but only under strict rules.

---

## CORE RULE

AI MUST NOT assume missing requirements.
Instead:
- Ask for clarification OR
- Mark it as "Open Decision" in decisions.md

---

## WHEN TO UPDATE AI_CONTEXT

AI MUST update context files when:

### 1. New Module is Introduced
Example:
- Payment gateway added
- New MLM bonus type added
- New admin feature introduced

👉 Action:
- Update project.md
- Update architecture.md
- Add module entry in tasks.md

---

### 2. New Business Rule is Defined
Example:
- Commission percentage changes
- Referral restrictions added
- Withdrawal rules updated

👉 Action:
- Update decisions.md
- Update conventions.md if logic changes

---

### 3. New API or System Flow is Added
👉 Action:
- Update api_contracts.md
- Update architecture.md (data flow section)

---

### 4. Code Pattern Changes
Example:
- Switching from Repository → Query Builder
- Adding Event-driven architecture

👉 Action:
- Update architecture.md
- Update conventions.md

---

## WHEN NOT TO UPDATE CONTEXT

AI MUST NOT update context when:
- It is a minor bug fix
- It is a local refactor
- It is temporary experimental code
- Requirement is unclear or unconfirmed

---

## HOW UPDATES MUST BE DONE

### RULE 1: Atomic Updates
Only update relevant sections. Never rewrite full files unless required.

---

### RULE 2: Log Every Important Decision

Before changing context, AI MUST log reasoning in:
- `decisions.md` for architectural or major logic changes.
- `current_state.md` for flow and state updates.
