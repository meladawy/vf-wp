# Group Header (block)

A textual introduction aside a group leader using the `vf-summary--profile` Visual Framework pattern.

If a header post is not available in the VF Blocks (or is blank), this plugin will try to use the EMBL Who taxonomy term and pull the group description from the ContentHub.

A "read more" to the about page will automatically be appended.

## Configuration

ACF / Block data:

| field key | field name | type |
| --------- | ---------- | ---- |
| field_vf_group_header_heading | vf_group_header_heading | [STRING] |

Block `name`: `acf/vf-group-header`

See plugin JSON file for source of truth.

### Related post

| post_name | post_type |
| --------- | --------- |
| vf_group_header | vf_block |

Default values can be assigned to this post using post meta and the "field name" listed above.

For example in `wp_postmeta`:

| meta_key | meta_value |
| -------- | ---------- |
| vf_group_header_heading | "Resources" |
| \_vf_group_header_heading | field_vf_group_header_heading |

### Heading

**Key**: `vf_group_header_heading`
**Value**: string (HTML)

A short heading that introduces the group, for example:

```html
<h1>The Sharpe group brings together an interdisciplinary team of biologists, physicists and computer scientists to build multi-scale computer simulations of a paradigm of organogenesis – mammalian limb development.</h1>
```

## Global Configuration

| option_name | option_value |
| ----------- | ------------ |
| options_embl_taxonomy_term_what | [TERM_ID] |

Option provided by the **EMBL Taxonomy** plugin.

Term name (e.g. "Sharpe Group") used to filter team leader API results.
